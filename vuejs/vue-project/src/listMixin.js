export default {
    data() {
        return {
            names: ['Vlad', 'Max', 'Elena', "igor"],
            searchName: ''
        }
    },
    computed: {
        filteredNames() {
            return this.names.filter(name => {
                return name.toLowerCase().indexOf(this.searchName.toLowerCase()) !== -1;
            });
        }
    },
    created() {
        console.log('created');
    }
}