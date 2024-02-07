<template>
  <Nav class="container mb-3 mt-4">
    <div class="d-flex justify-content-between">
        <div class="">
            <h4 class="fw-bold" style="color:#fc5185">Happy<span style="color: #000">Writers</span></h4>      
        </div>
        <div class="d-flex align-items-center"> 
            <div class="mx-2 btn btn-outline-dark btn-sm">
                <img src="https://pm1.aminoapps.com/6278/46d976910b261a600fa78ca382d193eee9de37cf_00.jpg" class="user-profile me-1" alt="">
                <span>Willian</span>
            </div>
        </div>
    </div>
    <hr>
  </Nav>

    <!-- Create Post -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="text-center">
                    <h3 class="my-3 fw-bold">Writing.....</h3>
                </div>
                <form class="my-3">
                    <div class="form-group my-4">
                        <label for="title"><h5>Title</h5></label>
                        <input type="text" id="title" class="form-control">
                    </div>
                    <div class="form-group my-4">
                        <label for="body"><h5>Body</h5></label>
                        <textarea class="form-control p-3" id="body" cols="30" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group my-4">
                                <label for="photo"><h5>Featured Photo</h5></label>
                                <input type="file" id="photo" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group my-4">
                                <label for="topic"><h5>Topic</h5></label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Minimalism</option>
                                    <option value="1">Life lessons</option>
                                    <option value="2">Psychology</option>
                                    <option value="3">Self-improvement</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn text-white px-4" style="background-color:#fc5185">Post</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
    
</style>