//Register test
//David McClung

describe('Check Register page', () => {
    it('Check Error message that email is already registered', () => {
        cy.visit('http://localhost/PHP/register.php')
        cy.get('[data-cy=first_name]').type('d')
            cy.get('[data-cy=last_name]').type('m')
            cy.get('[data-cy=date_of_birth]').type('02/07/1991')
            cy.get('[data-cy=country]').type('UK')
            cy.get('[data-cy=email]').type('dm@dm.com')
            cy.get('[data-cy=pass1]').type('123456')
            cy.get('[data-cy=pass2]').type('123456')
            cy.get('[data-cy=subscriberRadios]').click()
            cy.get('[data-cy=submit]').click()
            cy.get('[data-cy=error-msg]').should('contain', 'Email address already registered')
            cy.get('[data-cy=login-alert]').should('contain', 'Sign In Now').click()
    }
    )
}
)
