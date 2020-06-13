class Token{

    isValid(token){
        const payLoad = this.payLoad(token)
        if(payLoad){
            return payLoad.iss == "http://localhost:8000/api/auth/login" || "http://localhost:8000/api/auth/signup" ? true : false
        }
        return false
    }

    payLoad(token){
        const payLoad = token.split('.')[1]
        return this.decode(payLoad)
    }

    decode(payLoad){
        if(this.isBase64(payLoad)){
        return JSON.parse(atob(payLoad))
        }
        return false
    }

    isBase64(payLoad){
        try{
            return btoa(atob(payLoad)).replace(/=/g,"") == payLoad
        }
        catch(err){
            return false
        }
    }
}

export default Token = new Token()