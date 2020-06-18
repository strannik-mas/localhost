var MemberShip;
(function (MemberShip) {
    MemberShip[MemberShip["Simple"] = 0] = "Simple";
    MemberShip[MemberShip["Standard"] = 1] = "Standard";
    MemberShip[MemberShip["Premium"] = 2] = "Premium";
})(MemberShip || (MemberShip = {}));
var memberShip = MemberShip.Standard;
var memberShipReverse = MemberShip[2];
console.log(memberShip);
console.log(memberShipReverse);
var SocialMedia;
(function (SocialMedia) {
    SocialMedia["VK"] = "VK";
    SocialMedia["FACEBOOK"] = "FACEBOOK";
    SocialMedia["INSTA"] = "INSTA";
})(SocialMedia || (SocialMedia = {}));
var social = SocialMedia.INSTA;
console.log(social);
