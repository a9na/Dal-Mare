document.addEventListener("DOMContentLoaded", function() {
    // Open login modal
    document.getElementById('loginButton').onclick = function() {
        document.getElementById('loginModal').classList.remove('hidden');
    };

    // Open signup modal
    document.getElementById('signupButton').onclick = function() {
        document.getElementById('signupModal').classList.remove('hidden');
    };

    // Handle login form submission
    document.getElementById('loginForm').onsubmit = async function(e) {
        e.preventDefault();
        const username = document.getElementById('loginUsername').value;
        const password = document.getElementById('loginPassword').value;

        const response = await fetch('login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password })
        });

        const result = await response.json();
        if (result.success) {
            alert('Login successful!');
            document.getElementById('loginModal').classList.add('hidden');
            updateUI(result.username);
            if (result.user_type === 'admin') {
                window.location.href = 'admin_dashboard.php'; // Redirect to admin dashboard
            } else {
                window.location.href = 'user_dashboard.php'; // Redirect to user dashboard
            }
        } else {
            alert('Login failed: ' + result.message);
        }
    };

    // Handle signup form submission
    document.getElementById('signupForm').onsubmit = async function(e) {
        e.preventDefault();
        const username = document.getElementById('signupUsername').value;
        const email = document.getElementById('signupEmail').value;
        const password = document.getElementById('signupPassword').value;

        const response = await fetch('signup.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, email, password })
        });

        const result = await response.json();
        if (result.success) {
            alert('Signup successful!');
            document.getElementById('signupModal').classList.add('hidden');
            updateUI(result.username);
        } else {
            alert('Signup failed: ' + result.message);
        }
    };

    // Update the UI based on the user's login state
    function updateUI(username) {
        // Hide login and signup buttons
        document.getElementById('loginButton').style.display = 'none';
        document.getElementById('signupButton').style.display = 'none';

        // Show "Log Off" button and welcome message
        const userProfile = document.getElementById('userProfile');
        userProfile.innerHTML = `
            <span>Welcome, ${username}!</span>
            <button id="logoutButton" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Log Off</button>
        `;
        userProfile.style.display = 'block';

        // Handle logout
        document.getElementById('logoutButton').onclick = function() {
            fetch('logout.php')
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        window.location.reload(); // Refresh the page to reset the UI
                    }
                });
        };
    }
});