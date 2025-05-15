$(document).ready(function() {
    loadExpenses();

    $('#expenseForm').on('submit', function(e) {
        e.preventDefault();
        addExpense();
    });
});

function loadExpenses() {
    $.ajax({
        url: 'operations.php',
        type: 'GET',
        success: function(response) {
            $('#expenseList').html(response);
            calculateTotal();
        }
    });
}

function addExpense() {
    const expense = {
        description: $('#description').val(),
        amount: $('#amount').val(),
        category: $('#category').val(),
        date: $('#date').val(),
        action: 'add'
    };

    $.ajax({
        url: 'operations.php',
        type: 'POST',
        data: expense,
        success: function(response) {
            $('#expenseForm')[0].reset();
            loadExpenses();
        }
    });
}

function deleteExpense(id) {
    if(confirm('Are you sure you want to delete this expense?')) {
        $.ajax({
            url: 'operations.php',
            type: 'POST',
            data: {
                action: 'delete',
                id: id
            },
            success: function(response) {
                loadExpenses();
            }
        });
    }
}

function editExpense(id) {
    const row = $(`#expense-${id}`);
    const description = row.find('.description').text();
    const amount = row.find('.amount').text().replace('$', '');
    const category = row.find('.category').text();
    const date = row.find('.date').attr('data-date');

    $('#description').val(description);
    $('#amount').val(amount);
    $('#category').val(category);
    $('#date').val(date);

    // Change form submit action to update
    $('#expenseForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        updateExpense(id);
    });
}

function updateExpense(id) {
    const expense = {
        id: id,
        description: $('#description').val(),
        amount: $('#amount').val(),
        category: $('#category').val(),
        date: $('#date').val(),
        action: 'update'
    };

    $.ajax({
        url: 'operations.php',
        type: 'POST',
        data: expense,
        success: function(response) {
            $('#expenseForm')[0].reset();
            // Reset form submit action to add
            $('#expenseForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                addExpense();
            });
            loadExpenses();
        }
    });
}

function calculateTotal() {
    let total = 0;
    $('.amount').each(function() {
        total += parseFloat($(this).text().replace('$', ''));
    });
    $('#totalExpense').text('$' + total.toFixed(2));
}