// test-case1.js created with Cypress
//David McClung

//Test Case 1

//test case that goes to a website
describe('Webflix', function() {
    it('visits the website', function() {
        cy.visit('http://localhost/PHP/login.php')
    })
})



//test case that logs in
describe('Webflix', function() {
    it('logs in', function() {
        cy.get('div#email.txt_field').type('dm@dm.com')
        cy.get('div#password.txt_field').type('123')
        cy.get('input#Login-button').click()
    })
})

describe('Webflix', function() {
    it('clicks movie poster', function() {
        cy.get('img#Parasite').click()
    })
})