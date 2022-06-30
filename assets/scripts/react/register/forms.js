import PropTypes from 'prop-types';
import DatePicker from "react-datepicker";

const {useState, useEffect} = wp.element

const Input = props => {
    const [value, setValue] = useState(props.value)
    const usedType = props.type ?? 'text'
    const usedName = props.name ?? 'name'
    const usedLabel = props.label ?? 'Name'
    const onChange = e => {
        setValue(e.target.value)
    }
    useEffect(() => {
        console.log(value)
    }, [value])

    const usedPlaceholder = props.placeholder ?? ''
    return <>
        <label>{usedLabel}
            <input type={usedType}
                   name={usedName}
                   value={value}
                   placeholder={usedPlaceholder}
                   onChange={onChange}/>
        </label>
    </>
}
Input.propTypes = {
    name: PropTypes.string.isRequired,
    type: PropTypes.string,
    label: PropTypes.string,
    placeholder: PropTypes.string
}

const Select = props => {
    const [value, setValue] = useState(props.value)
    const usedName = props.name ?? 'name'
    const usedLabel = props.label ?? 'Name'
    const onChange = e => {
        setValue(e.target.value)
    }
    let usedOptions = [];
    props.options.map(opt => {
        usedOptions.push(<option>{opt}</option>)
    })
    useEffect(() => {
        console.log(value)
    }, [value])
    return <>
        <label>
            {usedLabel}
            <select name={usedName} onChange={onChange}>
                {usedOptions}
            </select>
        </label>
    </>
}
Select.propTypes = {
    name: PropTypes.string.isRequired,
    options: PropTypes.array.isRequired,
    label: PropTypes.string,
}

const DateP = props => {
    const [value, setValue] = useState(new Date())
    const usedLabel = props.label ?? 'Name'

    return <>
        <label>
            {usedLabel}
            <DatePicker selected={value} onChange={(date) => setValue(date)}/>
        </label>
    </>
}
DateP.propTypes = {
    label: PropTypes.string
}

const Button = props => {
    const usedLabel = props.label ?? 'Button'
    const onClick = e => {
        props.callback()
    }
    return <button className={`button button-${props.type}`} onClick={onClick}>{usedLabel}</button>
}
Button.propTypes = {
    label: PropTypes.string,
    type: PropTypes.oneOf(['success', 'warning', 'danger', 'primary', 'secondary']).isRequired,
    callback: PropTypes.func.isRequired
}

export {Input, Select, DateP, Button};