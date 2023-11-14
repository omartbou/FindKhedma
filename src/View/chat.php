<?php require_once 'includes/contentsidebar.php' ?>
<?php if(isset($_SESSION['logged'])&&$_SESSION['logged']===true) {
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'searcher' || $_SESSION['role'] === 'manager')) {?>

    <style>
        .hidden {
            display: none;
        }
        #messageArea {
            height: 400px; /* Set the desired height for your message area */
            overflow-y: auto;
            border: 1px solid #ccc; /* Optional: Add a border for a visual separation */
            padding: 10px; /* Optional: Add padding for better spacing */
        }
    </style>
<div class="wrapper d-flex align-items-stretch">

<?php require_once 'includes/sidebar.php';?>
<div id="content" class="p-4 p-md-5">
    <?php require_once 'includes/toggle.php';?>
    <?php include 'includes/alerts.php'; ?>

    <div class="container mt-5">

    <div class="row">
        <!-- Sidebar with user list -->
        <div class="col-md-4">
            <h4>Users</h4>
            <ul class="list-group" id="userList">
                <?php
                $data = new MessagesController();
                $users = $data->selectUsers();
                $displayedUsers = array();

                    foreach ($users as $user) {
                        $userKey = $user['id'];
                        if (!in_array($userKey, $displayedUsers)) {
                            array_push($displayedUsers, $userKey);

                            if ($_SESSION['role'] === 'manager') {
                                echo '<li class="list-group-item user" data-user-id="' . $user['id'] . '">' . $user['fname'] . ' ' . $user['lname'] . ' | ' . $user['email'] . '</li>';
                            } else {
                                echo '<li class="list-group-item user" data-user-id="' . $user['id'] . '">' . $user['company_name'] . '</li>';
                            }
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- Main chat area -->
        <div class="col-md-8">
            <div id="selectedUser"></div>
            <div id="messageArea">
                <!-- This will be populated with messages -->
            </div>
            <form id="messageForm" class="hidden">
                <div class="form-group">
                    <input type="text" name="message" class="form-control" id="messageInput" placeholder="Type your message...">
                </div>
                <input type="hidden" name="receiver_id"> <!-- Updated line -->

                <button type="submit" name="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>

    document.querySelectorAll('.user').forEach(user => {
        user.addEventListener('click', () => {
            const userId = user.getAttribute('data-user-id');
            const userName = user.textContent;

            // Set the receiver_id in the hidden input field
            const receiverIdInput = document.querySelector('input[name="receiver_id"]');
            receiverIdInput.value = userId; // Set the receiver_id to the selected user's ID

            // Highlight the selected user
            document.querySelectorAll('.user').forEach(u => {
                u.classList.remove('active');
            });
            user.classList.add('active');

            document.querySelector('#selectedUser').textContent = `Chatting with ${userName}`;
            displayMessages(userId);


            // Show the message sending form
            document.getElementById('messageForm').classList.remove('hidden');
        });
    });

    // Function to display messages for a specific user
    function displayMessages(userId) {
        if (!userId) {
            console.log("User ID is empty.");
            return;
        }

        // Clear the messageArea before loading new messages
        const messageArea = document.getElementById("messageArea");
        messageArea.innerHTML = ""; // Clear existing messages

        // Use AJAX to load messages
        // Use fetch to load messages
        fetch("getmessages?q=" + userId)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                messageArea.innerHTML = data; // Append new messages
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });

    }

    // Function to send a message
    function sendMessage(userId, message) {
        if (!userId || !message) {
            console.log("User ID or message is empty.");
            return;
        }

        fetch("sendmessage", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded", // Use form-urlencoded format
            },
            body: `userId=${encodeURIComponent(userId)}&message=${encodeURIComponent(message)}`, // Encode the data
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                console.log("User ID:", userId);
                console.log("Message:", message);
                console.log("Message sent successfully:", data);
            })

            .catch(error => {
                console.error("Fetch error:", error);
            });

    }

    document.querySelector('#messageForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        const userId = document.querySelector('.user.active').getAttribute('data-user-id');
        const messageInput = document.querySelector('#messageInput');
        const message = messageInput.value.trim();

        if (userId && message) {
            sendMessage(userId, message);
            messageInput.value = "";
        } else {
            console.log("User ID or message is empty.");
        }
    });
</script>
<?php } } else{
    Redirect::to('login');
} ?>