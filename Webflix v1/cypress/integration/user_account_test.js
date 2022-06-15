//Test Case #1 - User Account Test
// David McClung

describe('Step 1 - Visit Register page', () => {
    it('Visits the Webflix Register page', () => {
        cy.visit('http://localhost/PHP/register.php')
    }
    )
})

        describe('Step 2 - Register user', () => {
        it('Creates a new Subscriber account for user then submits it for register', () => {

                cy.get('[data-cy=first_name]').type('Arnold')
                cy.get('[data-cy=last_name]').type('Schwarzenegger')
                cy.get('[data-cy=date_of_birth]').type('30/07/1947')
                cy.get('[data-cy=country]').type('United States')
                cy.get('[data-cy=email]').type('as@as.com')
                cy.get('[data-cy=pass1]').type('123456')
                cy.get('[data-cy=pass2]').type('123456')
                cy.get('[data-cy=subscriberRadios]').click()
                cy.get('[data-cy=submit]').click()
                cy.url().should('include', '/PHP/success.php')
                cy.get('[data-cy=login_nav]').click()


            }
        )
    }
)

describe('Step 3 - Login user & View movie', () => {
    it('User should now be able to log in with registered account', () => {

        //user logs in
        cy.visit('http://localhost/PHP/login.php')
        cy.get('[data-cy=email]').type('as@as.com')
        cy.get('[data-cy=password]').type('123456')
        cy.get('[data-cy=submit]').click()
        cy.url().should('include', '/PHP/home.php')


        /*
        Note- that this test needs to be done within the
        same describe as Cypress naturally clears cookies in the browser
        for each new test run.
         */

        //user now views movie information and clicks watch now button
        cy.get('[data-cy=Parasite]').click()
        cy.url().should('include', '/PHP/movies.php?id=2')
        cy.get('.watch-button').click()


        }
    )

})





