<template>
    <div class="columns m-b-0">
        <div class="column is-four-fifths"><h3 class="align-right">${{payment.amount | price}}</h3></div>
        <div class="column"><p>{{payment.paid_on | date}}</p></div>
    </div>
</template>

<script>
export default {
    props: ['payment']
}
</script>
