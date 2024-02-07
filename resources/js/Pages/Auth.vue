<template>
  <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-lg-8 border mt-5 p-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-5">
                    <div v-if="isLogin">
                        <SignUp></SignUp>
                        <div class="mt-3 text-center">
                            <p class="mb-0">Already member? <span @click="isLogin=!isLogin;" class="text-decoration-underline text-info" style="cursor: pointer;">Login Account?</span></p>
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

<script setup>
import { ref } from 'vue'
import Login from '../components/Login.vue'
import SignUp from '../components/SignUp.vue'

    let isLogin=ref(true)

</script>

<style>

</style>