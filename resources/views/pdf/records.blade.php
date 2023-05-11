<!DOCTYPE html>
<html>

<head>
    <title>Alumni Records</title>
	<style>
        @page {
            margin: 7mm 7mm 7mm 7mm;
            size: folio landscape;
        }

        body,
        th,
        td {
            font-family: "Calibri", sans-serif;
            font-size: 14px; /* added font-size property */
        }

        h1 {
            font-size: 1.5rem;
            text-align: center;
			margin: 0;
        }

        h3 {
            text-align: center;
            margin-top: 1cm;
        }

        h4 {
            text-align: left;
            margin-top: 0.5cm;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1cm;
        }

        p {
            text-align: center;
            margin: 0;
        }

        th,
        td {
            text-align: left;
            padding: 0.5cm;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 0.9rem;
        }
		body {
            padding-bottom: 1cm;
        }
    </style>
</head>

<body>
    <main>
		<div>
            <h1>Mindoro State University</h1>
            <p>Calapan City Campus</p>
            <p>College Department</p>
        </div>
        <h3>Employability Status of Graduates A.Y. 2009-2010</h3>
        <h4>Department: BSED</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2009-2010' && $user->department == 'BSED')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: BTVTED</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2009-2010' && $user->department == 'BTVTED')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: Criminology</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2009-2010' && $user->department == 'Criminology')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: BSIT</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2009-2010' && $user->department == 'BSIT')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: CBM</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2009-2010' && $user->department == 'CBM')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: AB</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2009-2010' && $user->department == 'AB')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Employability Status of Graduates A.Y. 2010-2011</h3>
        <h4>Department: BSED</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2010-2011' && $user->department == 'BSED')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: BTVTED</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2010-2011' && $user->department == 'BTVTED')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: Criminology</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2010-2011' && $user->department == 'Criminology')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: BSIT</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2010-2011' && $user->department == 'BSIT')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: CBM</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2010-2011' && $user->department == 'CBM')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4>Department: AB</h4>
        <table>
            <thead>
                <th>No.</th>
                <th>NAME</th>
                <th>COMPANY/INSTITUTION WHERE EMPLOYED</th>
                <th>ADDRESS</th>
                <th>POSITION</th>
                <th>EMPLOYMENT STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                @foreach ($users as $user)
                    @if ($user->year_graduated == '2010-2011' && $user->department == 'AB')
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->work_company }}</td>
                            <td>{{ $user->home_address }}</td>
                            <td>{{ $user->position_on_work }}</td>
                            <td>{{ $user->employed_status }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endif
                @endforeach
                <?php if ($counter == 1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data Found!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </main>
</body>

</html>
