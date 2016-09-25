<template>
    <div id="paginator" v-show="previous || next">
        <nav>
            <ul class="pager">
                <li v-show="previous" class="previous">
                    <a @click.prevent="paginate('previous')" class="page-scroll" href="#">
                        < Previous
                    </a>
                </li>
                <li v-show="next" class="next">
                    <a @click.prevent="paginate('next')" class="page-scroll" href="#">
                        Next >
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                page: 1,
                next: false,
                previous: false
            }
        },

        methods: {
            paginate(direction) {
                if (direction === 'previous') {
                    --this.page;
                } else if (direction === 'next') {
                    ++this.page;
                }

                this.$dispatch('pageUpdated', this.page);
                this.$dispatch('paginationTriggered');
            },

            updatePagination(paginator) {
                this.next = paginator.next_page_url ? true : false;
                this.previous = paginator.prev_page_url ? true : false;
            }
        },

        events: {
            'responsePaginated': 'updatePagination'
        }

    };
</script>
