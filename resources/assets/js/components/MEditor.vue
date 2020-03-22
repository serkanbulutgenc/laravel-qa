<template>
    <div class="card ">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#write">Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#preview">View</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active" id="write">
                <slot></slot>
            </div>
            <div class="tab-pane" id="preview">
                <div>Preview.. </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MEditor",
        props:['body']
    }
</script>

<style scoped>

</style>
