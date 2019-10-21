<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title> ARSIPVEL </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Invoice
                <strong>{{ $datepayments }}</strong>
                <span class="float-right"> <strong>Status:</strong> Success</span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h6 class="mt-5 mb-3">From:</h6>
                            <div>
                                <strong>ARSIPVEL INDONESIA</strong>
                            </div>
                            <div>Madalinskiego 8</div>
                            <div>71-101 Szczecin, Poland</div>
                            <div>Email: info@webz.com.pl</div>
                        </div>
                        <div class="form-group">
                            <h6 class="mb-3">To:</h6>
                            <div>
                                <strong>{{ $name }}</strong>
                            </div>
                            <div>Job: {{ $job_name }}</div>
                            <div>Division: {{ $division_name }}</div>
                            <div>{{ $address }}</div>
                            <div>Email: {{ $email }}</div>
                        </div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center"></th>
                                <th>Item</th>
                                <th class="text-right">Unit Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center">1</td>
                                <td class="left">Salary</td>
                                <td class="text-right">${{ $salary }}</td>
                            </tr>
                            <tr>
                                <td class="center">2</td>
                                <td class="left">Bonus</td>
                                <td class="text-right">${{ $bonus }}</td>
                            </tr>
                            <tr>
                                <td class="center">3</td>
                                <td class="left">Salary Cuts</td>
                                <td class="text-right">${{ $salary_cuts }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">

                    </div>

                    <div class="col-lg-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="text-right">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-right">${{ $salary-$salary_cuts+$bonus }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>
</body>

</html>