<template>
    <div class="col m12">
        <div class="row">
            <nav>
                <div class="nav-wrapper">
                    <div class="col s12">
                        <a href="#" class="brand-logo">Code Contas</a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li v-for="o in links">
                                <a v-link="{name: o.routeName}">{{ o.label }}</a>
                            </li>
                        </ul>
                        <ul class="side-nav" id="mobile-demo">
                            <li v-for="o in links">
                                <a v-link="{name: o.routeName}">{{ o.label }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
              links: [
                {label: 'Contas a Pagar', routeName: 'bill-pay.list'}
              ]
            };
        },
        created() {
          Echo.channel('my-channel').listen('BillPayCreated', (e) => {
            console.log(e);
          });
            $(function() {
                $(".button-collapse").sideNav();
            });
        }
    }
</script>
