<script>
    export default {
        props: ['source'],
        data () {
            return {
                pages: []
            }
        },
        methods: {
            navigate (ev, page) {
                ev.preventDefault()
                this.$dispatch('navigate', page)
            },
            nextPrev (ev, page) {
                if (page == 0 || page == this.source.last_page+1) {
                    return;
                }
                this.navigate(ev, page)
            },
            generatePagesArray (currentPage, collectionLength, rowsPerPage, paginationRange) {
                let pages = []
                let totalPages = Math.ceil(collectionLength / rowsPerPage)
                let halfWay = Math.ceil(paginationRange / 2)
                let ellipsesNeeded = paginationRange < totalPages
                let position
                if (currentPage <= halfWay) {
                    position = 'start'
                } else if (totalPages - halfWay < currentPage) {
                    position = 'end'
                } else {
                    position = 'middle'
                }
                let i = 1
                while (i <= totalPages && i <= paginationRange) {
                    let pageNumber = this.calculatePageNumber(i, currentPage, paginationRange, totalPages)
                    let openingEllipsesNeeded = (i === 2 && (position === 'middle' || position === 'end'))
                    let closingEllipsesNeeded = (i === paginationRange - 1 && (position === 'middle' || position === 'start'))
                    if (ellipsesNeeded && (openingEllipsesNeeded || closingEllipsesNeeded)) {
                        pages.push('...')
                    } else {
                        pages.push(pageNumber)
                    }
                    i ++
                }
                return pages
            },
            calculatePageNumber (i, currentPage, paginationRange, totalPages) {
                let halfWay = Math.ceil(paginationRange/2)
                if (i === paginationRange) {
                    return totalPages
                } else if (i === 1) {
                    return i
                } else if (paginationRange < totalPages) {
                    if (totalPages - halfWay < currentPage) {
                        return totalPages - paginationRange + i
                    } else if (halfWay < currentPage) {
                        return currentPage - halfWay + i
                    } else {
                        return i
                    }
                } else {
                    return i
                }
            }
        },
        watch: {
            source () {
                let s = this.source
                this.pages = this.generatePagesArray(s.current_page, s.total, s.per_page, 12)
            }
        }
    }
</script>

<template>
    <nav>
      <div class="row">
          <div class="col s12">
            <ul class="pagination">
              <li :class="{disabled: source.current_page == 1 }">
                <a href="#" @click="nextPrev($event, source.current_page-1)" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <!-- <i class="material-icons">chevron_left</i> -->
                </a>
              </li>
              <li v-for="page in pages" track-by="$index" :class="{active: source.current_page == page }">
                  <span v-if="page == '...'">{{ page }}</span>
                  <a href="#" v-if="page != '...'" @click="navigate($event, page)">{{ page }} </a>
              </li>
              <li :class="{disabled: source.current_page == source.last_page }">
                <a href="#" @click="nextPrev($event, source.current_page+1)" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <!-- <i class="material-icons">chevron_right</i> -->
                </a>
              </li>
            </ul>
          </div>
      </div>
    </nav>
</template>
