<template>
    <div class="container">
        <div class="row">
            <div class="col m4 offset-m4">
                  <h4 class="center-align">Code Contas</h4>
                  <div class="row">
                    <form>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" v-model="user.email">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="pass" type="password" v-model="user.password">
                                    <label for="pass">Senha</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m12">
                                    <p class="center-align">
                                        <button class="btn btn-large btn-default" type="button" @click="login()">Entrar</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
              user: {
                  email: '',
                  password: ''
              }
            };
        },
        ready() {
            console.log('Component ready - Login Vue.')
        },
        methods: {
            login(){
              this.$http.post('http://localhost:8000/api/token', this.user)
                  .then((response) => {
                      console.log('Login Funcionando:::....');
                      window.localStorage.setItem('token', response.data.token);
                      this.$router.go({name: 'bill-pay.list'});
                  });
            }
        }
    }
</script>
