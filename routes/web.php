<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Auth\AdminLoginController;


Route::get('/', function () {
    return view('home.homepage');
});

Route::get('/bank', function () {
    return view('home.bank');
});
Route::get('/save', function () {
    return view('home.save');
});
Route::get('/borrow', function () {
    return view('home.borrow');
});
Route::get('/invest', function () {
    return view('home.invest');
});
Route::get('/insure', function () {
    return view('home.insure');
});
Route::get('/learn-and-plan', function () {
    return view('home.learn');
});
Route::get('/payments', function () {
    return view('home.payments');
});
Route::get('/credit-cards', function () {
    return view('home.credit-cards');
});
Route::get('/about-us', function () {
    return view('home.about');
});
Route::get('/checking-accounts', function () {
    return view('home.checking-accounts');
});
Route::get('/tax-checklist', function () {
    return view('home.tax-checklist');
});
Route::get('/how-to-save', function () {
    return view('home.how-to-save');
});
Route::get('/simple-ways', function () {
    return view('home.simple-ways');
});
Route::get('/the-impact', function () {
    return view('home.the-impact');
});
Route::get('/business-banking', function () {
    return view('home.business-banking');
});
Route::get('/customer-support', function () {
    return view("home.support");
});
Route::get('/news', function () {
    return view("home.news");
});
Route::get('/careers', function () {
    return view("home.careers");
});
Route::get('/giving-back', function () {
    return view("home.giving");
});
Route::get('/privacy-policy', function () {
    return view("home.privacy");
});
Route::get('/faqs', function () {
    return view("home.faqs");
});

Route::post('/registration', [AuthController::class, 'step1Submit'])->name('step1.submit');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Email & User Verification
Route::get('email/ver', [CustomAuthController::class, 'emailVerify'])->name('email_verify');
Route::get('user/ver', [CustomAuthController::class, 'userVerify'])->name('user_verify');
Route::get('/verify/{id}', [CustomAuthController::class, 'verify'])->name('verify');
Route::post('/verify-code', [CustomAuthController::class, 'verifyCode'])->name('verify.code');
Route::get('/resend-verification-code', [CustomAuthController::class, 'resendVerificationCode'])->name('resend.verification.code');


Route::get('/forgot-password', function () {
    return view('home.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');




Route::post('user-logout', [UserController::class, 'UserLogout'])->name('user.logout');


Route::get('/home', [UserController::class, 'index'])->name('user.home');
Route::prefix('user')->middleware('user')->group(function () {

    // Existing routes
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/investment', [UserController::class, 'investment'])->name('investment');
    Route::get('/loan', [UserController::class, 'loan'])->name('loan');
    // Profile Routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/upload-photo', [UserController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::get('/checking-page', [UserController::class, 'checkingPage'])->name('checking.page');
    Route::get('/checking-statement', [UserController::class, 'checkingStatement'])->name('checking.statement');
    Route::get('/savings-page', [UserController::class, 'savingsPage'])->name('savings.page');
    Route::get('/savings-statement', [UserController::class, 'savingsStatement'])->name('savings.statement');
    Route::get('/apply-loan', [App\Http\Controllers\User\LoanController::class, 'index'])->name('loan.history');
    Route::post('apply-/loan', [App\Http\Controllers\User\LoanController::class, 'apply'])->name('loan.apply');
    Route::get('/support', [App\Http\Controllers\User\SupportController::class, 'index'])->name('user.support');
    Route::post('/support', [App\Http\Controllers\User\SupportController::class, 'store'])->name('user.support.store');

    Route::get('/notifications', [App\Http\Controllers\User\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/data', [App\Http\Controllers\User\NotificationController::class, 'fetchNotifications'])->name('notifications.data');
    Route::get('/notifications/{id}', [App\Http\Controllers\User\NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications', [App\Http\Controllers\User\NotificationController::class, 'store'])->name('notifications.store');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\User\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{id}', [App\Http\Controllers\User\NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/transfer/{type}', [App\Http\Controllers\User\TransferController::class, 'showForm'])
        ->name('transfer.form')
        ->where('type', 'wire|local|internal|paypal|crypto|skrill');
    Route::post('/process', [App\Http\Controllers\User\TransferController::class, 'processTransfer'])->name('transfer.process');
    // Route::post('/home', [App\Http\Controllers\User\TransferController::class, 'confirmTax'])->name('transfer.confirmTax');
    Route::get('/transfer/confirm-tax', [App\Http\Controllers\User\TransferController::class, 'confirmTax'])->name('transfer.confirmTax');
    Route::post('/transfer/confirm-tax', [App\Http\Controllers\User\TransferController::class, 'confirmTax']);

    Route::get('/transfer/confirm-vat', [App\Http\Controllers\User\TransferController::class, 'confirmVAT'])->name('transfer.confirmVAT');
    Route::post('/transfer/confirm-vat', [App\Http\Controllers\User\TransferController::class, 'confirmVAT']);

    Route::get('/transfer/confirm-cot', [App\Http\Controllers\User\TransferController::class, 'confirmCOT'])->name('transfer.confirmCOT');
    Route::post('/transfer/confirm-cot', [App\Http\Controllers\User\TransferController::class, 'confirmCOT']);

    Route::get('/transfer/receipt', [App\Http\Controllers\User\TransferController::class, 'showReceipt'])->name('transfer.receipt');


    Route::get('/card-deposit', [App\Http\Controllers\User\CardDepositController::class, 'create'])->name('user.card.deposit.create');
    Route::post('/deposit', [App\Http\Controllers\User\CardDepositController::class, 'store'])->name('user.card.deposit.store');
    Route::get('/cheque-deposit', [App\Http\Controllers\User\ChequeDepositController::class, 'create'])->name('user.cheque.deposit.create');
    Route::post('/deposit', [App\Http\Controllers\User\ChequeDepositController::class, 'store'])->name('user.cheque.deposit.store');
    Route::get('/crypto-deposit', [UserController::class, 'cryptoDeposit'])->name('user.crypto.deposit');
});

Route::get('admin/login', [AdminLoginController::class, 'adminLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('login.submit');




// Admin Routes
Route::prefix('admin')->group(function () {

    // Protecting admin routes using the 'admin' middleware
    Route::middleware(['admin'])->group(function () { // Admin Profile Routes
        Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'editProfile'])->name('admin.profile');
        Route::post('/profile/update', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/profile/password', [App\Http\Controllers\Admin\AdminController::class, 'updatePassword'])->name('admin.profile.password.update');

        Route::get('/change/user/password/page/{id}', [App\Http\Controllers\Admin\AdminController::class, 'showResetPasswordForm'])->name('admin.change.user.password.page');
        Route::post('/user-password-reset', [App\Http\Controllers\Admin\AdminController::class, 'resetPassword'])->name('admin.user.password_reset');

        Route::get('{user}/verification', [App\Http\Controllers\Admin\AdminController::class, 'userVerification'])->name('user.verification');
        Route::get('{user}/suspension', [App\Http\Controllers\Admin\AdminController::class, 'userSuspension'])->name('user.suspension');


        Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
        Route::get('/payment-settings', [App\Http\Controllers\Admin\AdminController::class, 'paymentSettings'])->name('payment.settings');
        Route::get('/manage-users', [App\Http\Controllers\Admin\AdminController::class, 'manageUsersPage'])->name('manage.users.page');
        Route::get('/manage-transactions', [App\Http\Controllers\Admin\AdminController::class, 'manageTransactionsPage'])->name('manage.transactions.page');
        Route::get('/transactions/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'deleteTransaction'])->name('delete.transaction');
        Route::get('/transactions/approve/{id}', [App\Http\Controllers\Admin\AdminController::class, 'approveTransaction'])->name('approve.transaction');
        Route::get('/manage-investment-plan', [App\Http\Controllers\Admin\AdminController::class, 'manageInvestmentPlan'])->name('manage.investment.plan');
        Route::get('/view-deposit/{id}/', [App\Http\Controllers\Admin\AdminController::class, 'viewDeposit']);
        Route::get('/manage-kyc', [App\Http\Controllers\Admin\AdminController::class, 'manageKycPage'])->name('manage.kyc.page');
        Route::get('/accept-kyc/{id}/', [App\Http\Controllers\Admin\AdminController::class, 'acceptKyc'])->name('admin.accept.kyc');
        Route::get('/reject-kyc/{id}/', [App\Http\Controllers\Admin\AdminController::class, 'rejectKyc'])->name('admin.reject.kyc');
        Route::get('/reset-password/{user}', [App\Http\Controllers\Admin\AdminController::class, 'resetUserPassword'])->name('reset.password');
        Route::get('/clear-account/{id}', [App\Http\Controllers\Admin\AdminController::class, 'clearAccount'])->name('clear.account');

        Route::get('/{user}/impersonate',  [App\Http\Controllers\Admin\AdminController::class, 'impersonate'])->name('users.impersonate');
        Route::get('/leave-impersonate',  [App\Http\Controllers\Admin\AdminController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

        Route::post('/edit-user/{user}', [App\Http\Controllers\Admin\AdminController::class, 'editUser'])->name('edit.user');
        Route::post('/add-new-user',  [App\Http\Controllers\Admin\AdminController::class, 'newUser'])->name('add.user');
        Route::get('/delete-user/{user}',  [App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('delete.user');

        // Route for viewing user details
        Route::get('/user/{id}', [App\Http\Controllers\Admin\AdminController::class, 'viewUser'])->name('admin.user.view');
        Route::post('/transfer/suspend/{id}', [App\Http\Controllers\Admin\AdminController::class, 'suspendTransfer'])->name('transfer.suspend');
        Route::post('/transfer/unblock/{id}', [App\Http\Controllers\Admin\AdminController::class, 'unblockTransfer'])->name('transfer.unblock');
        Route::post('/account/suspend/{id}', [App\Http\Controllers\Admin\AdminController::class, 'suspendAccount'])->name('account.suspend');
        Route::post('/account/unblock/{id}', [App\Http\Controllers\Admin\AdminController::class, 'unblockAccount'])->name('account.unblock');

        // Define the route for opening an account
        Route::get('/user/open', [App\Http\Controllers\Admin\AdminController::class, 'openAccount'])->name('admin.user.open');





        Route::post('credit-debit', [App\Http\Controllers\Admin\AdminController::class, 'creditDebit'])->name('credit-debit');
        Route::post('credit', [App\Http\Controllers\Admin\AdminController::class, 'credit'])->name('credit');
        Route::post('debit', [App\Http\Controllers\Admin\AdminController::class, 'debit'])->name('debit');





        // Route for updating user details
        Route::post('/user/update/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateUserDetail'])->name('update_user_detail');

        // Route for updating bank details
        Route::post('/user/update/bank/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateBankDetail'])->name('update_bank_detail');

        // Route for fund user
        Route::get('/user/fund/{accountnumber}/{id}', [App\Http\Controllers\Admin\AdminController::class, 'fundUser'])->name('fund_user');

        // Route for user transaction history
        Route::get('/user/transaction/{id}', [App\Http\Controllers\Admin\AdminController::class, 'userTransaction'])->name('user_transaction');

        // Route for user transfer tracking
        Route::get('/user/transfer/tracking/{id}', [App\Http\Controllers\Admin\AdminController::class, 'userTransferTracking'])->name('user_transfer_tracking');

        // Route for debit user
        Route::get('/user/debit/{accountnumber}/{id}', [App\Http\Controllers\Admin\AdminController::class, 'debitUser'])->name('debit_user');

        // Route for changing user photo
        Route::get('/user/photo/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updatePhoto'])->name('update_photo');

        // Route for user activity
        Route::get('/user/activity/{id}', [App\Http\Controllers\Admin\AdminController::class, 'userActivity'])->name('user_activity');

        // Route for user password reset
        Route::get('/user/password/reset/{userid}', [App\Http\Controllers\Admin\AdminController::class, 'userPasswordReset'])->name('user_password_reset');


        // Route for changing email user
        Route::get('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailPage'])->name('send.email');
        Route::post('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmail'])->name('send.mail');


        // Route for changing email user
        Route::get('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailPage'])->name('send.email.page');
        Route::post('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendUserEmail'])->name('send.mail');


        Route::match(['get', 'post'], 'vat-code', [App\Http\Controllers\Admin\TransactionController::class, 'vatCode'])->name('vat-code');
        Route::post('/credit-savings', [App\Http\Controllers\Admin\TransactionController::class, 'creditSavings'])->name('credit.savings.balance');
        Route::post('/debit-savings', [App\Http\Controllers\Admin\TransactionController::class, 'debitSavings'])->name('debit.savings.balance');
        Route::post('/credit-checking', [App\Http\Controllers\Admin\TransactionController::class, 'creditChecking'])->name('credit.checking.balance');
        Route::post('/debit-checking', [App\Http\Controllers\Admin\TransactionController::class, 'debitChecking'])->name('debit.checking.balance');
        Route::post('/admin/update-user', [App\Http\Controllers\Admin\AdminController::class, 'adminUpdateUser'])->name('admin.updateUser');
        Route::post('/admin/toggle-account-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleAccountStatus'])
            ->name('admin.toggleAccountStatus');
        Route::post('/admin/toggle-email-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleEmailStatus'])
            ->name('admin.toggleEmailStatus');
        Route::post('/admin/user/toggle-email-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleEmailStatus'])->name('admin.user.toggleEmailStatus');
        Route::post('/admin/user/toggle-user-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleUserStatus'])->name('admin.user.toggleUserStatus');

        Route::get('getusers', [App\Http\Controllers\Admin\AdminController::class, 'getUsers'])->name('admin.getusers');
        Route::get('loan-history', [App\Http\Controllers\Admin\AdminController::class, 'loanHistory'])->name('admin.user.loan-history');
        Route::get('/transfer-histories', [\App\Http\Controllers\Admin\AdminController::class, 'transferHistory'])
            ->name('admin.transfers.index');
        Route::get('/cheque-deposits', [\App\Http\Controllers\Admin\AdminController::class, 'chequeHistory'])
            ->name('admin.cheque-deposits.index');

        Route::get('/cheque-deposits/{chequeDeposit}', [\App\Http\Controllers\Admin\AdminController::class, 'showChequeHistory'])
            ->name('admin.cheque-deposits.show');
        Route::get('/cheque-deposits/{chequeDeposit}', [App\Http\Controllers\Admin\ChequeDepositController::class, 'show'])->name('admin.cheque-deposits.show');
        Route::put('/cheque-deposits/{chequeDeposit}', [App\Http\Controllers\Admin\ChequeDepositController::class, 'update'])->name('admin.cheque-deposits.update');
        Route::delete('/cheque-deposits/{chequeDeposit}', [App\Http\Controllers\Admin\ChequeDepositController::class, 'destroy'])->name('admin.cheque-deposits.destroy');
    });
});
