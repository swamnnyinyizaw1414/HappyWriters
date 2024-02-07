<template>
  <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-8 border mt-5 p-5">
            <div class="row justify-content-center">
                <div class="col-5">
                    <div v-if="isLogin">
                        <SignUp></SignUp>
                        <div class="mt-3 text-center">
                            <p class="mb-0">Already member? <span @click="isLogin=!isLogin" class="text-decoration-underline text-info" style="cursor: pointer;">Login Account?</span></p>
                        </div>
                    </div>

                    <div v-else>
                        <Login></Login>
                        <div class="mt-3 text-center">
                            <p>Not a member? <span @click="isLogin=!isLogin" class="text-decoration-underline text-info" style="cursor: pointer;">Create account?</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import Login from '../components/Login'
import SignUp from '../components/SignUp'
export default {
  components: {
    Login, SignUp },

    setup(){
        let isLogin=ref(true);

        return {isLogin}
    }

}
</script>

<style>

</style>