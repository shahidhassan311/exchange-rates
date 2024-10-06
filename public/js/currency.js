const token = document.querySelector('meta[name="api-token"]').getAttribute('content');

function getHeaders() {
    return {
        'Authorization': 'Bearer ' + token
    };
}

function fetchCurrencies(page = 1) {
    $.ajax({
        url: `/api/currencies?page=${page}`,
        method: 'GET',
        headers: getHeaders(),
        success: function(data) {
            renderCurrencies(data.data);
            renderPagination(data);
        },
        error: function(xhr) {
            console.error('Error fetching currency data', xhr);
        }
    });
}

function renderCurrencies(currencies) {
    let rows = '';
    currencies.forEach(function(currency) {
        rows += `
                <tr>
                    <td>${currency.name}</td>
                    <td>${currency.rate}</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="fetchCurrencyDetails(${currency.id})">View Details</button>
                        <button class="btn btn-secondary btn-sm" onclick="fetchCurrencyHistory(${currency.id})">View History</button>
                    </td>
                </tr>`;
    });
    $('#currency-table-body').html(rows);
}

function renderPagination(data) {
    let pages = '';

    data.links.forEach(link => {
        if (link.url) {
            pages += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${link.label}); return false;">${link.label}</a>
                    </li>`;
        } else {
            pages += `
                    <li class="page-item disabled">
                        <span class="page-link">${link.label}</span>
                    </li>`;
        }
    });

    $('#pagination-controls').html(pages);
}

function changePage(page) {
    if (!isNaN(page)) {
        fetchCurrencies(page);
    }
}

function fetchCurrencyDetails(currencyId) {
    $.ajax({
        url: '/api/currencies/' + currencyId,
        method: 'GET',
        headers: getHeaders(),
        success: function(currency) {
            $('#currency-details').text(`Currency: ${currency.name}, Rate: ${currency.rate}`);
            $('#currencyDetailsModal').modal('show');
        },
        error: function(xhr) {
            console.error('Error fetching currency details', xhr);
        }
    });
}

function fetchCurrencyHistory(currencyId) {
    $.ajax({
        url: '/api/currencies/' + currencyId + '/history',
        method: 'GET',
        headers: getHeaders(),
        success: function(history) {
            let historyItems = '';
            history.forEach(function(entry) {
                // Parse the date and format it
                let date = new Date(entry.created_at);
                let formattedDate = date.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Build the history item
                historyItems += `<li>${formattedDate}: ${entry.rate}</li>`;
            });
            // Set the formatted history items to the list
            $('#currency-history-list').html(historyItems);
            $('#currencyHistoryModal').modal('show');
        },
        error: function(xhr) {
            console.error('Error fetching currency history', xhr);
        }
    });
}


// Debounce function to limit API calls
let debounceTimer;
function debounceFetchCurrencies() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => fetchCurrencies(), 500);
}

fetchCurrencies();
setInterval(debounceFetchCurrencies, 10000);
