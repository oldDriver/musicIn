Feature('Admin dashboard User');

Scenario('User dashboard test',  ({ I }) => {
    I.logout();
    I.login('admin@musicin.test', 'password');
    I.waitUrlEquals('/admin');
    I.waitForElement('nav#main-menu');
    I.click('Users', 'nav#main-menu');
    I.waitForElement('form.form-action-search input[name="query"]');
    I.logout();
});
