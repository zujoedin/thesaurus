<template >
    <div class="container">
        <div class="row">        
            <div class="sub-container">
                <slot></slot>
            </div>        
        </div>
    </div>
</template>

<style scoped>

.sub-container {
    border:1px solid #eceef3;
    background:#fff;
    border-radius: 5px;
    margin: 20px;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
    padding:20px;
    width: 100%;
}

</style>