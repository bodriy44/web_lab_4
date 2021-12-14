<template>
    <div class="cart">
        <span v-if="cart">{{cart.total}} ₽</span>
    </div>
</template>

<script>
export default {
    name: "CartInfo",
    data(){
        return{
            cart: null
        }
    },
    created(){
        this.$http.get('/cart/' + localStorage.userId)
        .then(response => this.cart = response.data)
    }
}
</script>

<style scoped>

</style>
