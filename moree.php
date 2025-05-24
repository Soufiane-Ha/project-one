<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { display: flex; justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .section-title { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Company Name</h2>
            <h2>Packing List</h2>
        </div>
        
        <table>
            <tr>
                <td>
                    <strong>SHIP FROM</strong><br>
                    Company Name<br>
                    Street Address<br>
                    City, ST ZIP<br>
                    Phone: 000-000-0000<br>
                    Fax: 000-000-0000<br>
                    Email: name@company.com
                </td>
                <td>
                    <strong>SHIP DATE:</strong> 6/11/2021<br>
                    <strong>SALES ORDER #:</strong> 12345<br>
                    <strong>ORDER DATE:</strong><br>
                    <strong>ORDER EMAIL:</strong><br>
                    <strong>PO #:</strong><br>
                    <strong>CARRIER:</strong> FEDEX FREIGHT, INC<br>
                    <strong>TRACKING #:</strong> 1234567890
                </td>
            </tr>
        </table>
        
        <table>
            <tr>
                <th>SHIP TO DESTINATION</th>
                <th>BILL TO</th>
            </tr>
            <tr>
                <td>
                    <strong>Name</strong><br>
                    <strong>Company Name</strong><br>
                    Street Address<br>
                    City, ST ZIP<br>
                    Phone
                </td>
                <td>
                    <strong>Name</strong><br>
                    <strong>Company Name</strong><br>
                    Street Address<br>
                    City, ST ZIP<br>
                    Phone
                </td>
            </tr>
        </table>
        
        <h3 class="section-title">PACKING LIST SUMMARY</h3>
        <table>
            <tr>
                <th>PACKAGE #</th>
                <th>DESCRIPTION</th>
                <th>SKU</th>
                <th>QTY</th>
                <th>WEIGHT (LB)</th>
                <th>LxWxH (IN)</th>
            </tr>
            <tr>
                <td>1-9</td>
                <td>Product A<br>Product B</td>
                <td>A-001<br>B-001</td>
                <td>10<br>140</td>
                <td>240.00</td>
                <td>12x12x20</td>
            </tr>
            <tr>
                <td>10-16</td>
                <td>Product C</td>
                <td>C-001</td>
                <td>42</td>
                <td>176.42</td>
                <td>12x12x12</td>
            </tr>
            <tr>
                <td>17</td>
                <td>Product D</td>
                <td>D-001</td>
                <td>2</td>
                <td>22.36</td>
                <td>12x12x12</td>
            </tr>
            <tr>
                <td>18</td>
                <td>Product E</td>
                <td>E-001</td>
                <td>1</td>
                <td>15.22</td>
                <td>12x12x12</td>
            </tr>
        </table>
        
        <h3 class="section-title">SHIPPING INSTRUCTIONS</h3>
        <p>RESIDENTIAL DELIVERY - LIFTGATE REQUIRED</p>
        <h3 style="text-align:center;">Thank You</h3>
    </div>
</body>
</html>