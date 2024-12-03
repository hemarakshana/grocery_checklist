<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Checklist App</title>

    <!-- Style CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.3) 0 5px 15px;
            width: 500px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        ul {
            list-style-type: none;
            padding: 0;
            font-size: 20px;
        }

        ul li {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 350px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 5px 0;
        }

        ul li a {
            margin-left: auto;
        }

        input[type="checkbox"] {
            margin-right: 1rem;
        }

        input[type="text"] {
            padding: 0.5rem;
            font-size: 1.2rem;
            width: 80%;
            margin-right: 0.5rem;
        }

        button {
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .remove-btn {
            border-bottom: 1px solid red;
            color: red;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Dashed line-through style for checked items */
        .dashed {
            text-decoration: line-through dashed;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <h1>Grocery Checklist App</h1>

            <form action="./endpoint/add-list.php" method="POST">
                <input type="text" name="item_name" id="newTodo" placeholder="Enter a new item" required />
                <button type="submit">Add</button>
            </form>

            <ul class="todos" id="todos">
                <?php
                // Database connection using PDO
                $dsn = 'mysql:host=localhost;dbname=grocery_list';
                $username = 'root'; // Update with your DB username
                $password = ''; // Update with your DB password

                try {
                    $pdo = new PDO($dsn, $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Fetch items from 'items' table
                    $sql = "SELECT * FROM items";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $checked = $row['is_active'] ? 'checked' : '';
                        $dashedClass = $row['is_active'] ? 'dashed' : '';
                        echo '<li class="todo">';
                        echo '<input type="checkbox" class="checkbox" data-id="' . $row['id'] . '" ' . $checked . '>';
                        echo '<span class="' . $dashedClass . '">' . htmlspecialchars($row['name']) . '</span>';
                        echo '<a class="remove-btn" href="endpoint/delete-list.php?id=' . $row['id'] . '">Remove</a>';
                        echo '</li>';
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Script JS -->
    <script>
        // Add event listener to checkboxes
        document.querySelectorAll('.checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const itemId = this.getAttribute('data-id');
                const isChecked = this.checked ? 1 : 0;
                const todoText = this.nextElementSibling;

                // Send AJAX request to update status
                fetch(`endpoint/update-status.php?id=${itemId}&is_active=${isChecked}`)
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'success') {
                            // Toggle the dashed class based on checkbox state
                            if (isChecked) {
                                todoText.classList.add('dashed');
                            } else {
                                todoText.classList.remove('dashed');
                            }
                        } else {
                            alert('Failed to update status');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
</body>

</html>
