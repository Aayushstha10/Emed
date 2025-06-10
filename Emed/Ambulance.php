<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulance Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:linear-gradient(45deg, blueviolet, lightgreen);
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: green;
            text-shadow: 0 5px 10px rgba(0,0,0,.2);
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: green;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>

</head>
<body>

    <div id="ambulanceDetails">
        <h1>Hospital Details</h1>
    <table>
        <thead>
            <tr>
                <th>Hospital Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Norvic International Hospital</td>
                <td>Thapathali, Kathmandu, Nepal.</td>
                <td>+977-9803111111 / +977-9803222222</td>
                <td>info@norvichospital.com</td>
            </tr>
            <tr>
                <td>Grande International Hospital</td>
                <td>Dhapasi, Kathmandu, Nepal</td>
                <td>+977 9801202545, 01 5159077</td>
                <td>info@grandehospital.com</td>
            </tr>
            <tr>
                <td>B & B Hospital</td>
                <td>Gwarko, Lalitpur, Nepal</td>
                <td>+977-01-5970999, 01-5431933,
                    01-5431930</td>
                <td>admin@bnbhospital.com</td>
            </tr>
            <tr>
                <td>Nobel Hospital</td>
                <td>Sinamangal, Kathmandu, Nepal</td>
                <td>+977-01-5970999, 01-5431933,
                    01-5431930</td>
                <td>admin@bnbhospital.com</td>
            </tr>
            <tr>
                <td>Nepal Mediciti</td>
                <td>Bhaisepati, Lalitpur, Nepal</td>
                <td>+977-01-5970999, 01-5431933,
                    01-5431930</td>
                <td>admin@bnbhospital.com</td>
            </tr>
            <tr>
                <td>Nepal Eye Hospital</td>
                <td>Tripureshwor, Kathmandu, Nepal</td>
                <td>4250691</td>
                <td>info@nepaleyehospital.org</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
    </div>

</body>
</html>
