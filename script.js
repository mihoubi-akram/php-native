//1.fetch user data
const fetchUserData = async (url) => {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`error Status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error("Error fetching:", error);
        throw error;
    }
  };

//2. remove email from user data
const removeEmail = (userData) => {
    const { email, ...rest } = userData;
    return rest;
};

