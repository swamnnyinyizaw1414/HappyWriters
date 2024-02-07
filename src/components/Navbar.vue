<template>
  <Nav class="container mb-3 mt-4">
    <div class="d-flex justify-content-between">
        <div class="">
            <h4 class="fw-bold" style="color:#fc5185">Happy<span style="color: #000">Writers</span></h4>      
        </div>
        
        <div class="d-flex align-items-center">
            <div class=" mx-2">
            <i class="bi bi-pencil-square me-1"></i>
            <span>Write</span>
            </div>
            <div class="mx-2">
                <input type="text" placeholder="Search..." class="form-control" name="search">
            </div>
            <div class="mx-2">
                <button class="btn btn-outline-dark btn-sm">Sign Up</button>
            </div>
            <div class="mx-2 btn btn-outline-dark btn-sm">
                <img src="https://pm1.aminoapps.com/6278/46d976910b261a600fa78ca382d193eee9de37cf_00.jpg" class="user-profile me-1" alt="">
                <span>Willian</span>
            </div>
        </div>
    </div>
    <hr>
  </Nav>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
</script>

<style>
    .user-profile{
        width: 25px;
        height: 25px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>