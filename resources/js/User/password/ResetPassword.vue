<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Email</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="col-12 text-secondary">Email</label>
                    <input type="text" name="email"  class="form-controll col-4 text-center rounded" />

                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ /* options */ });

export default{

}

</script>
