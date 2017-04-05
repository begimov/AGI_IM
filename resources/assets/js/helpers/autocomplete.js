import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

let index = algolia('59XVB6Q0P9', '780048d9423c57d8d94353dfbf823eae')

export const userAutocomplete = (selector, {hitsPerPage}) => {

    index = index.initIndex('users')

    return autocomplete(selector, {}, {
        source: autocomplete.sources.hits(index, {hitsPerPage}),
        displayKey: 'name',
        templates: {
            suggestion(suggestion) {
                return `<span>${suggestion._highlightResult.name.value}</span>`
            },
            empty: '<div class="aa-empty">No users found</div>'
        }
    })
}
