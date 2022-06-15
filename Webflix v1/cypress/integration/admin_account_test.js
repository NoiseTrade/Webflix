//Test Case #2 - Admin Account Test
// David McClung

describe('Step 1 - Visit Admin login and register page', () => {
    it('Visits the Webflix Register page', () => {
            cy.visit('http://localhost/PHP/admin_panel/admin_login_register.php')
        }
    )
})

describe('Step 2 - Registers a new admin', () => {
    it('Admin should register for a new account', () => {

        cy.get('[data-cy=first_name]').type('Sylvester')
        cy.get('[data-cy=last_name]').type('Stallone')
        cy.get('[data-cy=register_email]').type('ss@ss.com')
        cy.get('[data-cy=register_pass1]').type('12345')
        cy.get('[data-cy=register_pass2]').type('12345')
        cy.get('[data-cy=register_button]').click()
        cy.get('[data-cy=success]').should('contain', 'Successfuly registered, please log in')


    })
})

describe('Step 3 - Logs in as admin', () => {
    it('Admin should be able to log in then edit a users details', () => {

        // log the admin in
        cy.visit('http://localhost/PHP/admin_panel/admin_login_register.php')
        cy.get('[data-cy=login_email]').type('ss@ss.com')
        cy.get('[data-cy=login_password]').type('12345')
        cy.get('[data-cy=login_button]').click()

        cy.url().should('include', 'admin_index.php')


        // edit a users details
        cy.get(':nth-child(3) > :nth-child(8) > a').click()
        cy.url().should('include', 'user_id=9')

        cy.get('[data-cy=first_name]').clear().type('David')
        cy.get('[data-cy=last_name]').clear().type('McClung')
        cy.get('[data-cy=dob]').clear().type('02/07/1991')
        cy.get('[data-cy=country]').clear().type('Scotland')
        cy.get('[data-cy=email]').clear().type('david@david.com')
        cy.get('[data-cy=account_type]').clear().type('Subscriber')
        cy.get('[data-cy=update]').click()
        cy.get(':nth-child(3) > :nth-child(6)').should('contain', 'david@david.com')

    })
})