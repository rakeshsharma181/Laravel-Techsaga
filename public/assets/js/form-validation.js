$(document).ready(function() {
    $.validator.addMethod("strong_password", function (value, element) {
        let password = value;
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password);
    },'password must contain 1 specical char, 1 Number , 1 Capital Character, 1 Small Letter, Length 8 to 16 chars)');
    $("#regForm").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                strong_password: true,
            },
            "hobbies[]": {
                required: true,
                minlength:2,
            },
            image:{
                required: true,
                accept: "image/jpg|jpeg|png",

            }
        },
        messages: {
            name: {
                required: "First name is required",
            },
            email: {
                required: "Email is required",
                email: "Email must be a valid email address",
            },
            password: {
                required: "Password is required",
            },
            "hobbies[]": "Please select at least two hobby",
            image: {
                required:"Please upload image,Max size 300 KB, allowed file type - JPG/PNG",

            }
        }
    });
});