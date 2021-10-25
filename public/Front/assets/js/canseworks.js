function validateItem(data) {
    const errors = data.responseJSON.errors
    const firstItem = Object.keys(errors)[0]
    const firstItemMessage = errors[firstItem][0]
    return firstItemMessage
}
