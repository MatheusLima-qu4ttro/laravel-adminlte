<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration Form - Glassmorphism Style</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .glass-form {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
            width: 450px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .glass-form h3 {
            text-align: center;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #fff;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            outline: none;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            border: none;
            background: #2575fc;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #1a54c8;
        }
    </style>
</head>
<body>
<div class="glass-form">
    <h3>Company Registration</h3>
    <form>
        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" id="name" placeholder="Enter company name">
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" placeholder="Enter CNPJ">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" placeholder="Enter address">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" placeholder="Enter phone number">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="foundationDate">Foundation Date</label>
            <input type="date" id="foundationDate">
        </div>
        <div class="form-group">
            <label for="industry">Industry</label>
            <input type="text" id="industry" placeholder="Enter industry">
        </div>
        <div class="form-group">
            <label for="size">Company Size</label>
            <select id="size">
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
            </select>
        </div>
        <div class="form-group">
            <label for="legalRepresentativeName">Legal Representative Name</label>
            <input type="text" id="legalRepresentativeName" placeholder="Enter legal representative name">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" id="website" placeholder="Enter website URL">
        </div>
        <div class="form-group">
            <label for="numberOfEmployees">Number of Employees</label>
            <input type="number" id="numberOfEmployees" placeholder="Enter number of employees">
        </div>
        <div class="form-group">
            <label for="stateRegistration">State Registration</label>
            <input type="text" id="stateRegistration" placeholder="Enter state registration">
        </div>
        <button type="submit" class="btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
