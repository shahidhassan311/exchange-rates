<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Rates</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/currency.css') }}"  rel="stylesheet">
    <meta name="api-token" content="JKeXX2O9vCorvTIOLGtMCvMfVnY178QH2YhlO8IwRohrUzkAseTyRnZThOEx">
</head>
<body>

<div class="container">
    <h1>Exchange Rates</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Currency</th>
            <th>Rate (USD)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="currency-table-body">
        </tbody>
    </table>

    <nav>
        <ul class="pagination" id="pagination-controls"></ul>
    </nav>
</div>

<!-- Currency Details Modal -->
<div class="modal fade" id="currencyDetailsModal" tabindex="-1" role="dialog" aria-labelledby="currencyDetailsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="currencyDetailsLabel">Currency Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="currency-details"></p>
            </div>
        </div>
    </div>
</div>

<!-- Currency History Modal -->
<div class="modal fade" id="currencyHistoryModal" tabindex="-1" role="dialog" aria-labelledby="currencyHistoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="currencyHistoryLabel">Currency History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="currency-history-list"></ul>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/currency.js') }}"></script>

</body>
</html>
