document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registration-form");
    const profileSection = document.getElementById("profile-section");
    const profileInfo = document.getElementById("profile-info");
    const editProfileButton = document.getElementById("edit-profile");
    const deleteProfileButton = document.getElementById("delete-profile");
    const updateProfileButton = document.getElementById("update-profile");

    registrationForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(registrationForm);

        console.log("Before fetch for registration");
        fetch("register.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(user => {
            console.log("After fetch for registration, user:", user);
            displayUserProfile(user);
            registrationForm.reset();
            editProfileButton.style.display = "inline-block";
            deleteProfileButton.style.display = "inline-block";
            updateProfileButton.style.display = "none";
        });
    });

    editProfileButton.addEventListener("click", function () {
        profileSection.style.display = "none";
        registrationForm.style.display = "block";

        fetch("get_user.php")
            .then(response => response.json())
            .then(user => {
                registrationForm.full_name.value = user.full_name;
                registrationForm.age.value = user.age;
                registrationForm.phone_number.value = user.phone_number;
                registrationForm.address.value = user.address;
                registrationForm.city.value = user.city;
                registrationForm.zip_code.value = user.zip_code;
            });

        editProfileButton.style.display = "none";
        deleteProfileButton.style.display = "none";
        updateProfileButton.style.display = "inline-block";
    });

    deleteProfileButton.addEventListener("click", function () {
        if (confirm("Are you sure you want to delete your profile?")) {
            fetch("delete_profile.php", {
                method: "POST"
            })
            .then(response => response.json())
            .then(() => {
                registrationForm.reset();
                profileSection.style.display = "none";
                registrationForm.style.display = "block";
            });
        }
    });

    updateProfileButton.addEventListener("click", function () {
        const formData = new FormData(registrationForm);

        fetch("update_profile.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(user => {
            displayUserProfile(user);
            registrationForm.reset();
            editProfileButton.style.display = "inline-block";
            deleteProfileButton.style.display = "inline-block";
            updateProfileButton.style.display = "none";
        });
    });

    function displayUserProfile(user) {
        profileInfo.innerHTML = `
            <li><strong>Full Name:</strong> ${user.full_name}</li>
            <li><strong>Age:</strong> ${user.age}</li>
            <li><strong>Phone Number:</strong> ${user.phone_number}</li>
            <li><strong>Address:</strong> ${user.address}</li>
            <li><strong>City:</strong> ${user.city}</li>
            <li><strong>Zip Code:</strong> ${user.zip_code}</li>
        `;

        registrationForm.style.display = "none";
        profileSection.style.display = "block";
    }

    fetch("get_user.php")
        .then(response => response.json())
        .then(user => {
            if (user) {
                displayUserProfile(user);
            }
        });
});
