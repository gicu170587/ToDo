import axios from 'axios'
export function registerUser(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/register', credentials)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('An error occured..data not inserted.')
        })
    })
}

export function login(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/login', credentials)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Wrong Email/Password combination.')
        })
    })
}

export function InsertItem(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/item/store', {
            item: credentials,
          })
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('An error occured..data not inserted.')
        })
    })
}


export function getLoggedinUser(){
    const userStr = localStorage.getItem('user');

    if(!userStr){
        return null
    }

    return JSON.parse(userStr);
}