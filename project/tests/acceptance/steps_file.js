// in this file you can append custom step methods to 'I' object

module.exports = function() {
  return actor({

    // Define custom steps here, use 'this' to access default methods of I.
    // It is recommended to place a general 'login' function here.
    login: function(login, password) {
        this.amOnPage('/login');
        this.waitForElement('form#login-form');
        this.waitForElement('form#login-form input#username');
        this.waitForElement('form#login-form input#password');
        this.waitForElement('form#login-form button[type="submit"]');
        this.fillField('form#login-form input#username', login);
        this.fillField('form#login-form input#password', password);
        this.click('Login');
    },

    logout: function () {
        this.amOnPage('/logout');
        this.waitUrlEquals('/');
    }

  });
}
