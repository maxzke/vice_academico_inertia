<template>
    <span class="border-none">
        <span v-if="value">$ {{ this.formateadoMoneda(value) }}</span>
        <span v-else><slot /></span>
    </span>
</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
    props: {
        value: String,
    },
    data() {
        return {
            importe: 0,
        };
    },
    methods: {
        formateadoMoneda(importe) {
            return this.formatNumber(importe, 1, ".", ",");
        },
        formatNumber(n, c, d, t) {
            var c = isNaN((c = Math.abs(c))) ? 2 : c,
                d = d === undefined ? "." : d,
                t = t === undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = String(parseInt((n = Math.abs(Number(n) || 0).toFixed(c)))),
                j = (j = i.length) > 3 ? j % 3 : 0;
            return (
                s +
                (j ? i.substr(0, j) + t : "") +
                i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +
                (c
                    ? d +
                      Math.abs(n - i)
                          .toFixed(c)
                          .slice(2)
                    : "")
            );
        },
    },
});
</script>
