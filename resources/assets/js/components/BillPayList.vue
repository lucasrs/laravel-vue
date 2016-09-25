<template>
    <div class="container">
        <div class="row">
            <div class="col m8 offset-m2">
                <h4 class="center-align">Minhas Contas a pagar</h4>
                <div>
                    <a class="waves-effect waves-light btn-large" v-link="{name: 'bill-pay.create'}" type="buttons">
                      <i class="material-icons right">add</i>Novo
                    </a>
                </div>
                <br/>
                <div class="row">
                    <div class="input-field col s10">
                        <input type="search" v-model="MySearch" class="form-control" placeholder="Busca de contas a pagar">
                        <i class="material-icons prefix">search</i>
                    </div>
                </div>
                <div class="row">
                    <table class="highlight striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><a href="#" @click="sort($event, 'name')">Nome</a></th>
                            <th>Vencimento</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(index,o) in bills | filterBy MySearch 'name' | orderBy sortProperty sortDirection">
                            <!-- <td>{{ index + 1 }}</td> -->
                            <td>{{ o.id }}</td>
                            <td>{{ o.name }}</td>
                            <td>{{ o.date_due }}</td>
                            <td>{{ o.value }}</td>
                            <td>
                                <a class="btn-floating green" v-link="{name: 'bill-pay.update', params: {id: o.id}}">
                                  <i class="large material-icons">mode_edit</i>
                                </a>
                                <a class="btn-floating red" href="#" @click.prevent="destroy(o)">
                                  <i class="large material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <ls-pagination :source="pagination" @navigate="navigate"></ls-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LsPagination from './Pagination.vue'
    export default {
        components: {
            LsPagination
        },
        props: ['bills'],
        data () {
            return {
                sortProperty: 'name',
                sortDirection: 1,
                MySearch:'',
                pagination: {}
            }
        },
        methods: {
            navigate (page) {
                this.$http.get('http://localhost:8000/api/bill_pays?page='+page).then((req) => {
                    this.bills = req.data.data
                    this.pagination = req.data
                })
            },
            sort (ev, property) {
                ev.preventDefault()
                this.sortProperty = property
                if (this.sortDirection == 1) {
                    this.sortDirection = -1
                } else {
                    this.sortDirection = 1
                }
            },
            destroy(o){
                  this.$http.delete(`http://localhost:8000/api/bill_pays/${o.id}`).then((response) => {
                  this.bills.$remove(o);
                });
            }
        },
        ready () {
            this.$http.get('http://localhost:8000/api/bill_pays').then((req) => {
                this.bills = req.data.data
                this.pagination = req.data
            })
        }
    }
</script>
