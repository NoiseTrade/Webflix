//login test case
//David McClung


//test case that goes to a website
describe('Webflix', function() {
    it('visits the website', function() {
        cy.visit('http://localhost/PHP/login.php')
    })
})

//test case to click the login button
describe('Login button handling', function() {
    it('clicks the login button to check functionality and checks for errors', function() {
            cy.get('[data-cy=submit]').click()
            cy.get('[data-cy=email]').type('dm@dm.com')
            cy.get('[data-cy=submit]').click()
            cy.get('[data-cy=password]').type('321')
            cy.get('[data-cy=submit]').click()
            cy.get('[data-cy=error]').should('contain', 'Oops! There was a problem: Please try again - Email address and password not found')

    }
    )
}
)

//test case to check the login header button
describe('Login navigation button handling', function() {
    it('clicks the login header button to check functionality ', function() {

        cy.get('[data-cy=login_nav]').click()
        cy.url().should('include', '/PHP/login.php')

    }
    )
}
)

//test case to check the register header button
describe('Register navigation button handling', function() {
        it('clicks the login header button to check functionality ', function() {

                cy.get('[data-cy=register_nav]').click()
                cy.url().should('include', '/PHP/register.php')

            }
        )
    }
)


//test case to click the login button
describe('Successfully Login to website', function() {
        it('enters correct login details to successfully log in', function() {

                cy.visit('http://localhost/PHP/login.php')
                cy.get('[data-cy=email]').type('dm@dm.com')
                cy.get('[data-cy=password]').type('123')
                cy.get('[data-cy=submit]').click()
                cy.url().should('include', '/PHP/home.php')

            }
        )
    }
)
