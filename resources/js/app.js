window.spotlightSearch = (config) => {
    const component = window.Livewire.find(config.componentId);

    return {
        inputPlaceholder: component.get('inputPlaceholder'),
        shouldGroup: component.get('shouldGroup'),
        showNoResultsView: component.get('showNoResultsView'),
        showInitialView: component.get('showInitialView'),

        queryResultsList: null,
        queryResults: component.entangle('results'),

        selected: 0,
        isOpen: component.entangle('isOpen').defer,
        input: '',

        init() {
            this.$watch('queryResults', value => {
                this.queryResultsList = value
            });

            this.$watch('input', async value => {
                if (value.length === 0) {
                    this.selected = 0;
                }

                await this.$wire.search(value)
            });

            this.$watch('isOpen', value => {
                if (value === false) {
                    setTimeout(() => {
                        this.input = '';
                        this.inputPlaceholder = config.placeholder;
                    }, 300);
                }
            });
        },

        toggleOpen() {
            if (this.isOpen) {
                this.isOpen = false;
                return;
            }
            this.input = ''
            this.isOpen = true
            setTimeout(() => {
                this.$refs.input.focus()
            }, 100)
        },

        filteredItems() {
            if (this.queryResultsList && this.queryResultsList.length) {
                return this.queryResultsList
            }

            return [];
        },

        goTo(id, searchable) {
            component.onSelect(id, searchable);
        },
    };
};
