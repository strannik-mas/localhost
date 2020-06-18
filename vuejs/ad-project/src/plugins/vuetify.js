import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuetify)

export default new Vuetify({
    icons: {
        iconfont: 'mdi' // default - only for display purposes
    },
    theme: {
        themes: {
            light:{
                primary: colors.pink.lighten3,
                secondary: "#3f51b5",
                accent: "#f44336",
                error: "#607d8b",
                warning: "#ff5722",
                info: "#00bcd4",
                success: "#009688"
            },
            dark: {
                primary: colors.blue.lighten3,
            },
        },
    }
})
