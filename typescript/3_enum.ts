enum MemberShip {
    Simple,
    Standard,
    Premium
}

const memberShip = MemberShip.Standard
const memberShipReverse = MemberShip[2]
console.log(memberShip)
console.log(memberShipReverse)

enum SocialMedia {
    VK = "VK",
    FACEBOOK = "FACEBOOK",
    INSTA = "INSTA"
}

const social = SocialMedia.INSTA
console.log(social)
