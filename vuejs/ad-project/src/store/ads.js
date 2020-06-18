import * as fb from 'firebase'

class Ad {
    title
    description
    ownerId
    imageSrc
    promo
    id
    constructor (title, description, ownerId, imageSrc = '', promo = false, id = null) {
        this.title = title
        this.description = description
        this.ownerId = ownerId
        this.imageSrc = imageSrc
        this.promo = promo
        this.id = id
    }
}

export default {
    state: {
        ads: [
            /*{
                title: 'First ad',
                description: 'asdf sdalfj; asdf  adsf',
                promo: false,
                imageSrc: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
                id: '123'
            },
            {
                title: 'Second ad',
                description: 'asdf sdalfj; asdf  adsf',
                promo: true,
                imageSrc: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
                id: '654'
            },
            {
                title: 'Third ad',
                description: 'asdf sdalfj; asdf  adsf',
                promo: true,
                imageSrc: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
                id: '65499'
            }*/
        ]
    },
    mutations: {
        createAd(state, payload) {
            state.ads.push(payload)
        },
        loadAds (state, payload) {
            state.ads = payload
        },
        updateAd(state, {title, description, id}) {
            const ad = state.ads.find(a => {
                return a.id === id
            })

            ad.title = title
            ad.description = description
        }
    },
    actions: {
        async createAd({commit, getters}, payload) {
            //payload.id = 'asdfsdfasdf'

            // commit('createAd', payload)

            const image = payload.image

            commit('clearError')
            commit('setLoading', true)
            console.log(getters.user.id)
            try {
                const newAd = new Ad(payload.title, payload.description, getters.user.id, '', payload.promo)

                //сохранение записи в бд без imageSrc
                const ad = fb.database().ref('ads').push(newAd);
                console.log(ad)


                const imageExt = image.name.slice(image.name.lastIndexOf('.'))
                //сохранение файла в storage
                const fileData = await fb.storage().ref(`ads/${ad.key}${imageExt}`).put(image)
                // const imageSrc = fileData.metadata.downloadURLs[0]
                const imageSrc = await fb.storage().ref().child(fileData.ref.fullPath).getDownloadURL()
                console.log(imageSrc)

                //обновление записи в бд с imageSrc
                await fb.database().ref('ads').child(ad.key).update({
                    imageSrc
                })



                commit('createAd', {
                    ...newAd,
                    id: ad.key,
                    imageSrc
                })
            } catch(error){
                commit('setError', error.message)
                throw  error
            } finally {
                commit('setLoading', false)
            }
        },
        async fetchAds ({commit}) {
            commit('clearError')
            commit('setLoading', true)

            const resultAds = []

            try {
                const fbVal = await fb.database().ref('ads').once('value') //выборка
                const ads = fbVal.val()
                Object.keys(ads).forEach(key=>{
                    const ad = ads[key]
                    resultAds.push(
                        new Ad(ad.title, ad.description, ad.ownerId, ad.imageSrc, ad.promo, key)
                    )
                })
                commit('loadAds', resultAds)
            } catch(error){
                commit('setError', error.message)
                throw  error
            } finally {
                commit('setLoading', false)
            }
        },
        async updateAd ({commit}, {title, description, id}) {
            commit("clearError")
            commit("setLoading", true)

            try {
                await fb.database().ref('ads').child(id).update({
                    title, description
                })
                commit('updateAd', {title, description, id})
                commit('setLoading', false)
            } catch (e) {
                commit('setError', e.message)
                commit('setLoading', false)
                throw e
            }
        }
    },
    getters: {
        ads(state) {
            return state.ads
        },
        promoAds(state) {
            return state.ads.filter(ad => {
                return ad.promo
            })
        },
        myAds(state, getters) {
            return state.ads.filter(ad => {
                return ad.ownerId === getters.user.id
            })
        },
        adById(state){
            return adId => {
                return state.ads.find(ad => ad.id === adId)
            }
        }
    }
}
