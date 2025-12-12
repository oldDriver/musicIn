Feature('Admin dashboard');

Scenario('dashboard test',  ({ I }) => {
    I.logout();
    I.login('admin@musicin.test', 'password');
    I.waitUrlEquals('/admin');
    I.waitForElement('nav#main-menu');
    I.logout();
});
