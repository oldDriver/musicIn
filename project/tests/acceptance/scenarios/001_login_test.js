Feature('login');

Scenario('Login test',  ({ I }) => {
    I.logout();
    I.login('admin@musicin.test', 'password');
    I.waitUrlEquals('/admin');
    I.logout();
    I.login('dummy@musicin.test', 'password');
    I.waitUrlEquals('/login');
    I.waitForText('Invalid credentials', 'form#login-form section div.alert-danger');
    I.login('user@musicin.test', 'password');
    I.waitUrlEquals('/');
    I.logout();
    I.waitUrlEquals('/');
});
