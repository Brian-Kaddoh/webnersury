<?php
include 'includes/config.php';

// Get the search type from the request
$treeType = $_GET['type'] ?? '';

// Prepare and execute the query based on the tree type
$query = "SELECT * FROM trees WHERE category = :category";
$stmt = $pdo->prepare($query);
$stmt->execute(['category' => $treeType]);

// Fetch all results
$trees = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the results as JSON
header('Content-Type: application/json');
echo json_encode($trees);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Search</title>
    <script>
        function searchTrees() {
            const treeType = document.getElementById('treeType').value;
            fetch(`search.php?type=${treeType}`)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '';

                    data.forEach(tree => {
                        const treeDiv = document.createElement('div');
                        treeDiv.innerHTML = `
                            <h3>${tree.name}</h3>
                            <p><strong>Scientific Name:</strong> ${tree.scientific_name}</p>
                            <p><strong>Description:</strong> ${tree.description}</p>
                            <p><strong>Price:</strong> $${tree.price}</p>
                            <p><strong>Category:</strong> ${tree.category}</p>
                            <img src="${tree.image_url}" alt="${tree.name}" style="width:200px;">
                        `;
                        resultsDiv.appendChild(treeDiv);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
    <h1>Find the Perfect Tree</h1>
    <form onsubmit="event.preventDefault(); searchTrees();">
        <label for="treeType">Select Tree Type:</label>
        <select id="treeType">
            <option value="Fruit Tree">Fruit Tree</option>
            <option value="Shade Tree">Shade Tree</option>
            <option value="Flowering Tree">Flowering Tree</option>
            <option value="Ornamental Tree">Ornamental Tree</option>
            <option value="Timber Tree">Timber Tree</option>
        </select>
        <button type="submit">Search</button>
    </form>
    <div id="results"></div>
</body>
</html>

