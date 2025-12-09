/**
 * BLOCK: pdf-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';


const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { InspectorControls, BlockControls, MediaUpload } = wp.blockEditor;
const { Fragment, useState } = wp.element;
const { 
	PanelBody,
	PanelRow,
	ToggleControl,
	TextControl,
	Button,
	Popover,
	IconButton,
	Toolbar,
	ToolbarButton
} = wp.components;
const { isURL } = wp.url;

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'pdfb/pdf-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'PDF' ), // Block title.
	icon: 'pdf', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'embed', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'PDF' ),
		__( 'embed' ),
		__( 'file' ),
		__( 'viewer' ),
		__( 'oembed' ),
	],
	attributes: {
		showToolbar: {
			type: 'boolean',
			default: false
		},
		url: {
			type: 'string',
			default: null
		},
		height: {
			type: 'number',
			default: 1015
		}
	},
	example: {
		attributes: {
			showToolbar: false,
			url: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
			height: 615,
		},
	},
	supports: {
		align: ['wide', 'full']
	},
	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Component.
	 */
	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		const parameters = attributes.showToolbar ? '' : '?t#toolbar=0&navpanes=0&scrollbar=0';		
		const [showUrlPopover, setShowUrlPopover] = useState(false);
		const [temporaryUrl, setTemporaryUrl] = useState('');

		const toggleUrlPopover = () => {
			setShowUrlPopover( !showUrlPopover )
		}

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'Options', 'pdfb' ) } >
						<PanelRow>
							<TextControl
								className="pdfb-textcontrol"
								label={ __( 'PDF File (URL)', 'pdfb' ) }
								value={ attributes.url }
								onChange={ ( value ) => setAttributes( {url: value } ) }
							/>
						</PanelRow>
						<PanelRow className="pdfb-panelrow">
							<MediaUpload 
								allowedTypes={ ['application/pdf'] }
								onSelect={(value) => {
									setAttributes({
										url: value.url,
									})
								}}
								render={ ({open}) => {
									return (
										<Button
											isSecondary
											onClick={open}
										>
											{ attributes.url ? (
												<span>Change PDF File</span>
											) : (
												<span>Upload PDF File</span>
											) }
										</Button>
									)
								}}
            				/>
						</PanelRow>
						{ attributes.url && (
							<Fragment>
								<PanelRow>
									<TextControl
										className="pdfb-textcontrol"
										label={ __( 'Height (in pixels)', 'pdfb' ) }
										type="number"
										min={ 100 }
										step= { 50 }
										value={ attributes.height }
										onChange={ ( value ) => setAttributes( {height: value } ) }
									/>
								</PanelRow>
								<PanelRow className="pdfb-panelrow">
									<ToggleControl
										label={ __( 'Show Toolbar', 'pdfb' ) }
										checked={ attributes.showToolbar }
										onChange={ ( value ) => {
											setAttributes( {showToolbar: value} );
										} }
									/>
								</PanelRow>
							</Fragment>
						) }
					</PanelBody>
				</InspectorControls>
				{ attributes.url && (
					<BlockControls>
						<Toolbar className="pdfb-toolbar">
							<MediaUpload 
								allowedTypes={ ['application/pdf'] }
								onSelect={(value) => {
									setAttributes({
										url: value.url,
									})
								}}
								render={ ({open}) => {
									return (
										<Button
											onClick={open}
										>
											Change PDF File
										</Button>
									)
								}}
							/>
						</Toolbar>
					</BlockControls>
				)}
				<div className={ props.className } style={ { height: attributes.url ? `${attributes.height}px` : '400px' } }>
					{ attributes.url ? (
						<iframe src={ attributes.url + parameters } width="100%" height="100%">
						</iframe>
					) : (
						<div className="pdfb-message">
							<div className="pdfb-heading">
								{ __('Choose a PDF File to get started.', 'pdfb')}
							</div>
							<div className="pdfb-actions">
								<MediaUpload 
									allowedTypes={ ['application/pdf'] }
									onSelect={(value) => {
										setAttributes({
											url: value.url,
										})
									}}
									render={ ({open}) => {
										return (
											<Button
												isSecondary
												onClick={open}
											>
												{ __('Upload PDF File', 'pdfb') }
											</Button>
										)
									}}
								/>
								<Button
									isSecondary
									onClick={ () => setShowUrlPopover(true) }
								>
									{ __('Insert From URL', 'pdfb') }
									{ showUrlPopover && (
										<Popover
											className="pdfb-popover"
											position="bottom center"
											onClose={ () => setShowUrlPopover(false) }
										>
											<TextControl
												className="pdfb-popover-textcontrol"
												placeholder={ __('Paste or type URL', 'pdfb') }
												value={ temporaryUrl }
												type="url"
												onChange={ (value) => setTemporaryUrl(value) }
											/>
											<IconButton
												icon="editor-break"
												label="Apply"
												onClick={ () => {
													if ( isURL( temporaryUrl ) ) {
														setAttributes({url: temporaryUrl} )
														setTemporaryUrl('')
													}
												} }
											/>
										</Popover>
									) }
								</Button>
							</div>
						</div>
					)}
				</div>
			</Fragment>
		);
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Frontend HTML.
	 */
	save: ( props ) => {
		const { attributes } = props;
		const parameters = attributes.showToolbar ? '' : '?t#toolbar=0&navpanes=0&scrollbar=0';

		return (
			<div className={ props.className } style={ { height: attributes.url ? `${attributes.height}px` : '400px' } }>
				{ attributes.url && (
					<iframe src={ attributes.url + parameters } width="100%" height="100%">
    				</iframe>
				)}
			</div>
		);
	},
} );
