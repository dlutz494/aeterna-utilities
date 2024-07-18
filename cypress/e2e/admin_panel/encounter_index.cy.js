describe('The Encounter Index', () => {
    beforeEach(() => {
        cy.visit('/encounters');
    });

    it('has "Create New Encounter" link', () => {
        cy.getBySel('create-encounter-link').should('contain.text', 'Create New Encounter');
    });

    it('has encounter table', () => {
        cy.get('table')
            .should('contain.text', 'Title')
            .should('contain.text', 'Description')
            .should('contain.text', 'Context(s)')
            .should('contain.text', 'Weight(s)')
            .should('contain.text', 'Actions');
    });

    it('has pagination', () => {
        cy.getBySel('pagination')
            .should('contain.text', 'Back')
            .should('contain.text', '1')
            .should('contain.text', '2')
            .should('contain.text', 'Next');
    });

    it('has filter dropdown', () => {
        cy.get('select').should('contain.text', 'Filter');
    });

    it('has "Clear Sorting" button', () => {
        cy.getBySel('clear-sorting').should('contain.text', 'Clear Sorting');
    });

    it('sorts by weight ascending', () => {
        cy.getBySel('weight-header').click();
        cy.getBySel('weight-header').should('contain.text', '▲');

        cy.get(':nth-child(1) > :nth-child(4) > ul > li').then((firstWeight) => {
            const first = parseInt(firstWeight.text());

            cy.get(':nth-child(15) > :nth-child(4) > ul > li').then((lastWeight) => {
                const last = parseInt(lastWeight.text());

                expect(first).to.be.lessThan(last);
            });
        });
    });

    it('sorts by weight descending', () => {
        cy.getBySel('weight-header').click();
        cy.getBySel('weight-header').click();
        cy.getBySel('weight-header').should('contain.text', '▼');

        cy.get(':nth-child(1) > :nth-child(4) > ul > li').then((firstWeight) => {
            const first = parseInt(firstWeight.text());

            cy.get(':nth-child(15) > :nth-child(4) > ul > li').then((lastWeight) => {
                const last = parseInt(lastWeight.text());

                expect(first).to.be.greaterThan(last);
            });
        });
    });

    it('sorts by title ascending', () => {
        cy.get('tbody > :nth-child(1) > :nth-child(1)').then((firstTitle) => {
            const first = firstTitle.text();
            cy.getBySel('title-header').click();
            cy.getBySel('title-header').should('contain.text', '▲');

            cy.get('tbody > :nth-child(1) > :nth-child(1)').then((newFirstTitle) => {
                const newFirst = newFirstTitle.text();
                const isSorted = (newFirst < first);
                expect(isSorted).to.be.true;
            });
        });
    });

    it('sorts by title descending', () => {
        cy.get('tbody > :nth-child(1) > :nth-child(1)').then((firstTitle) => {
            const first = firstTitle.text();
            cy.getBySel('title-header').click();
            cy.getBySel('title-header').click();
            cy.getBySel('title-header').should('contain.text', '▼');

            cy.get('tbody > :nth-child(1) > :nth-child(1)').then((newFirstTitle) => {
                const newFirst = newFirstTitle.text();
                const isSorted = (newFirst > first);
                expect(isSorted).to.be.true;
            });
        });
    });

    it('changes the page by selecting one', () => {
        cy.get('tbody > :nth-child(1) > :nth-child(1)').then((title) => {
            const titleText = title.text();

            cy.get('[data-cy="pagination"] > :nth-child(3) > .bg-white').click();

            cy.get('tbody > :nth-child(1) > :nth-child(1)').then((newTitle) => {
                const newTitleText = newTitle.text();

                expect(newTitleText).to.not.equal(titleText);
            });
        });
    });

    it('changes the page by clicking "Next" and "Back"', () => {
        cy.get('tbody > :nth-child(1) > :nth-child(1)').then((title) => {
            const titleText = title.text();

            cy.getBySel('page-next').click();

            cy.get('tbody > :nth-child(1) > :nth-child(1)').then((newTitle) => {
                const newTitleText = newTitle.text();

                expect(newTitleText).to.not.equal(titleText);

                cy.getBySel('page-back').click();

                cy.get('tbody > :nth-child(1) > :nth-child(1)').then((oldTitle) => {
                    const oldTitleText = oldTitle.text();

                    expect(oldTitleText).to.not.equal(newTitleText);
                    expect(oldTitleText).to.equal(titleText);
                });
            });
        });
    });

    it('clears sorting', () => {
        cy.get('tbody > :nth-child(1) > :nth-child(1)').then((firstTitle) => {
            const firstTitleText = firstTitle.text();
            cy.getBySel('title-header').click();
            cy.getBySel('title-header').should('contain.text', '▲');

            cy.get('tbody > :nth-child(1) > :nth-child(1)').then((newFirstTitle) => {
                const newFirstTitleText = newFirstTitle.text();

                expect(newFirstTitleText).to.not.equal(firstTitleText);

                cy.getBySel('clear-sorting').click();

                cy.get('tbody > :nth-child(1) > :nth-child(1)').then((oldFirstTitle) => {
                    const oldFirstTitleText = oldFirstTitle.text();
                    cy.getBySel('title-header').should('not.contain.text', '▲');
                    expect(oldFirstTitleText).to.equal(firstTitleText);
                });
            });
        });
    });
});
