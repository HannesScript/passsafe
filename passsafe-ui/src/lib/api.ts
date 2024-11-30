export async function getServiceData(uid: number, servicename: String): Promise<any> {
    const response = await fetch(`https://cycoran.com/backend/passsafe/getpassword?uid=${uid}&servicename=${servicename}`);
    return await response.json();
}

export async function getServices(uid: number): Promise<any> {
    const response = await fetch(`https://cycoran.com/backend/passsafe/getallpasswords?uid=${uid}`);
    return await response.json();
}

export function addService(uid: number, servicename: String, data: Object) {
    return fetch(`https://cycoran.com/backend/passsafe/createpassword`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({uid: uid, servicename: servicename, data: data})
    });
}

export function updateService(uid: number, servicename: String, data: Object) {
    return fetch(`https://cycoran.com/backend/passsafe/updatepassword`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({uid: uid, servicename: servicename, data: data})
    });
}

export function deleteService(uid: number, servicename: String) {
    return fetch(`https://cycoran.com/backend/passsafe/deletepassword?uid=${uid}&servicename=${servicename}`);
}

export async function registerUser(email: String, data: Object): Promise<any> {
    const response = await fetch(`https://cycoran.com/backend/passsafe/createuser`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, data })
    });
    return await response;
}

export async function loginUser(email: String): Promise<any> {
    return await fetch(`https://cycoran.com/backend/passsafe/uidbyemail?email=${email}`, {
        method: 'GET'
    }).then(response => response);
}