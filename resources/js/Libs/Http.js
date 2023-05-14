export default {
	get(url,params){
		return this.request('get',url,{params});
	},
	post(url,params){
		return this.request('post',url,params);
	},
	request(method,url,data){
		return axios[method](url,data);
	},

	async getCookie(name) {
	  const value = `; ${document.cookie}`;
	  const parts = value.split(`; ${name}=`);
	  if (parts.length === 2) return parts.pop().split(';').shift();
	}


}