<html>
    <head>
        <title>Test</title>
        <style>
            .error {
                color: #F00;
            }
        </style>
    </head>
    <body>
        <h1>Multi Contact Form</h1>
        <h3>Contact</h3>
        <form action="/submitContact.php" method="post">
            <label for="name">Name</label>
            <input id="name" name="name" type="text"/>
            <div class="error" id="nameError"></div>

            <label for="email">Email</label>
            <input id="email" name="email" type="text"/>
            <div class="error" id="emailError"></div>

            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" type="text"/>
            <div class="error" id="phoneError"></div>

            <input type="submit" value="Save"/>
            <input id="validate" type="button" value="Validate"/>
            <input type="submit" value="Add Contact"/>

        </form>

    </body>

    <script>
        class FormValidator {

            nameRegex = /^[a-z\sA-Z]+$/;
            emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            numberRegex = /^[0-9]+$/;

            Validate(name,email,phone)
            {
                let nameValid = this.nameRegex.test(name);
                let emailValid = this.emailRegex.test(email);
                let numberValid = this.numberRegex.test(phone);
                document.getElementById("nameError").innerHTML = "";
                document.getElementById("emailError").innerHTML = "";
                document.getElementById("phoneError").innerHTML = "";

                if (!nameValid) {
                    document.getElementById("nameError").innerHTML = "Name must contain only letters and spaces.";
                }

                if (!emailValid) {
                    document.getElementById("emailError").innerHTML = "Email must be a valid email.";
                }

                if (!numberValid) {
                    document.getElementById("phoneError").innerHTML = "Phone number must be valid.";
                }

                return nameValid && emailValid && numberValid;
            }

        }

        let fv = new FormValidator();

        document.getElementById("validate").addEventListener("click", function() {
            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let phone = document.getElementById("phone").value;
            fv.Validate(name,email,phone);
        });
    </script>

</html>